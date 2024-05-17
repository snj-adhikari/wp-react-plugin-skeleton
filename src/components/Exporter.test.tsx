import { render, fireEvent, act, waitFor } from '@testing-library/react';
import Exporter from './Exporter'; // replace with actual path
import { QueryClient, QueryClientProvider } from 'react-query';
import { sendGetRequest } from '../helpers/api'; // replace with actual path
import React from 'react';

jest.mock('../helpers/api', () => ({
	sendGetRequest: jest.fn(),
	useQueryClient: jest.fn(() => ({
		// Mock any methods of QueryClient that you use
	})),
}));
global.URL.createObjectURL = jest.fn();

// Wait for the functions to be called
declare global {
	interface Window {
		csvData: string;
	}
}

// Wrap the read operation in a Promise
const readAsText = (blob: Blob) => new Promise<string>((resolve) => {
	const reader = new FileReader();
	reader.readAsText(blob);
	reader.onloadend = () => {
		resolve(reader.result as string);
	};
});
describe('Exporter', () => {
	const originalCreateElement = document.createElement.bind(document);
	let csvData = 'title,excerpt,content\nTest title,Test excerpt,Test content' as string;

	const setCsvData = async (blob : Blob) => {
		csvData = await readAsText(blob as Blob);
	}

	const createObjectURLMock = jest.spyOn(URL, 'createObjectURL').mockImplementation((blob) => {
		// Convert the Blob to a string and store it in a variable
		setCsvData(blob as Blob);
		return 'dummyURL';
	});



	const createElementMock = jest.spyOn(document, 'createElement').mockImplementation((tagName) => {
		const element = originalCreateElement(tagName) as HTMLAnchorElement;

		element.href = '';
		element.download = '';
		element.click = jest.fn();
		return element;
	});



	it('it should export data to the csv file', async () => {
		const mockData = [
			{
				id: 1,
				title: { rendered: 'Test title' },
				excerpt: { rendered: 'Test excerpt' },
				content: { rendered: 'Test content' },
			},
			// more mock data...
		];

		const fetchQueryMock = jest.spyOn(QueryClient.prototype, 'fetchQuery').mockImplementation(async () => {
			return { data: mockData };
		});

		// Click the button
		const setExportingMock = jest.fn(); // Declare the 'setExportingMock' function

		(sendGetRequest as jest.Mock).mockImplementation(() => Promise.resolve(mockData));

		const props  = {
			queryKey: 'testQueryKey',
			exportKeys: ['title', 'excerpt', 'content'],
			url: 'testUrl',
			params: { per_page: 10, page: 1 },
			totalPages: 1,
			setExporting: setExportingMock, // Pass the mock directly as a prop
		};

		const queryClient = new QueryClient();
		const App = (
			<QueryClientProvider client={queryClient}>
				<Exporter {...props} />
			</QueryClientProvider>
		);
		const { getByText } = render(App);


		act(() => {
			fireEvent.click(getByText('Export to CSV'));
		});

		// Check that the button text has changed to 'Exporting...
		expect(getByText('Exporting...')).toBeDefined();

		await waitFor(() => {
			expect(fetchQueryMock).toHaveBeenCalled();
			expect(createObjectURLMock).toHaveBeenCalled();
			expect(createElementMock).toHaveBeenCalledWith('a');
		}, { timeout: 5000 });


		// Check the CSV data
		const expectedCSVContent = `title,excerpt,content\nTest title,Test excerpt,Test content`; // Adjust header and expected data based on your exportKeys
		expect(csvData.trim()).toBe(expectedCSVContent);

	});
});
