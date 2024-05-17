import React from 'react';
import { render } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import SearchResults from './SearchResults'; // Replace with the path to your component
import { useQuery, UseQueryResult} from 'react-query'; // Add missing import

jest.mock('react-query', () => ({
	useQuery: jest.fn(),
	QueryClient: jest.fn(() => ({
		// Mock any methods of QueryClient that you use
	})),
}));
jest.mock('./Exporter', () => {
	return jest.fn(() => <div>Mock Exporter</div>);
});

const mockData = {
	data: [
		{
			id: 1,
			serialNumber: 1,
			title: {
				rendered: 'Test Post Title',
			},
			link: 'https://example.com/test-post',
		},
		{
			id: 2,
			serialNumber: 2,
			title: {
				rendered: 'Test Post Title 2',
			},
			link: 'https://example.com/test-post-2',
		},
		{
			id: 3,
			serialNumber: 3,
			title: {
				rendered: 'Test Post Title 3',
			},
			link: 'https://example.com/test-post-3',
		},
		{
			id: 4,
			serialNumber: 4,
			title: {
				rendered: 'Test Post Title 4',
			},
			link: 'https://example.com/test-post-4',
		},
		{
			id: 5,
			serialNumber: 5,
			title: {
				rendered: 'Test Post Title 5',
			},
			link: 'https://example.com/test-post-5',
		},
		{
			id: 6,
			serialNumber: 6,
			title: {
				rendered: 'Test Post Title 6',
			},
			link: 'https://example.com/test-post-6',
		},
		{
			id: 7,
			serialNumber: 7,
			title: {
				rendered: 'Test Post Title 7',
			},
			link: 'https://example.com/test-post-7',
		},
		{
			id: 8,
			serialNumber: 8,
			title: {
				rendered: 'Test Post Title 8',
			},
			link: 'https://example.com/test-post-8',
		},
		{
			id: 9,
			serialNumber: 9,
			title: {
				rendered: 'Test Post Title 9',
			},
			link: 'https://example.com/test-post-9',
		},
		{
			id: 10,
			serialNumber: 10,
			title: {
				rendered: 'Test Post Title 10',
			},
			link: 'https://example.com/test-post-10',
		},
		{
			id: 11,
			serialNumber: 11,
			title: {
				rendered: 'Test Post Title 11',
			},
			link: 'https://example.com/test-post-11',
		},
		{
			id: 12,
			serialNumber: 12,
			title: {
				rendered: 'Test Post Title 12',
			},
			link: 'https://example.com/test-post-12',
		},
		{
			id: 13,
			serialNumber: 13,
			title: {
				rendered: 'Test Post Title 13',
			},
			link: 'https://example.com/test-post-13',
		},
		{
			id: 14,
			serialNumber: 14,
			title: {
				rendered: 'Test Post Title 14',
			},
			link: 'https://example.com/test-post-14',
		},
		{
			id: 15,
			serialNumber: 15,
			title: {
				rendered: 'Test Post Title 15',
			},
			link: 'https://example.com/test-post-15',
		},
		{
			id: 16,
			serialNumber: 16,
			title: {
				rendered: 'Test Post Title 16',
			},
			link: 'https://example.com/test-post-16',
		},
		{
			id: 17,
			serialNumber: 17,
			title: {
				rendered: 'Test Post Title 17',
			},
			link: 'https://example.com/test-post-17',
		},
		{
			id: 18,
			serialNumber: 18,
			title: {
				rendered: 'Test Post Title 18',
			},
			link: 'https://example.com/test-post-18',
		},
		{
			id: 19,
			serialNumber: 19,
			title: {
				rendered: 'Test Post Title 19',
			},
			link: 'https://example.com/test-post-19',
		},
		{
			id: 20,
			serialNumber: 20,
			title: {
				rendered: 'Test Post Title 20',
			},
			link: 'https://example.com/test-post-20',
		},
	],
	header: new Headers({
		'x-wp-total': '10',
		'x-wp-totalpages': '2',
	}),
};

const mockError = {
	message: 'Error fetching data',
};

describe('SearchResults component', () => {
	beforeEach(() => {
		(useQuery as jest.Mock<UseQueryResult | any >).mockReturnValue({ // Fix incorrect typing and function call
			isLoading: false,
			isFetching: false,
			error: undefined,
			data: mockData,
			refetch: jest.fn(),
		});
	});

	it('should render search results table with data', async () => {
		const {  getAllByText, getAllByRole } = render(<SearchResults postType="post" keyword="test" baseUrl="https://www.nowtolove.com.au/" />);

		// Wait for data to be fetched (assuming useQuery resolves a promise)
		const table = getAllByRole('table');
		const titleCell = getAllByText(/Test Post Title/);

		expect(table).toBeDefined();
		expect(titleCell).toBeDefined();
	});

	(useQuery as jest.Mock<UseQueryResult | any >).mockReturnValueOnce({
		isLoading: true,
		isFetching: false,
		error: null,
		data: undefined,
		refetch: jest.fn(),
	});

	const { getByText} = render(<SearchResults postType="post" keyword="test" baseUrl="https://example.com" />);

	expect(getByText(/Loading/i)).toBeDefined();

	it('should render error message if data fetching fails', () => {
		(useQuery as jest.Mock<UseQueryResult | any >).mockReturnValueOnce({ // Fix incorrect typing and function call
			isLoading: false,
			isFetching: false,
			error: mockError,
			data: undefined,
			refetch: jest.fn(),
		});

		const {getByText} = render(<SearchResults postType="post" keyword="test" baseUrl="https://example.com" />);

		expect( getByText(/Error/i)).toBeDefined();
	});

	it('should handle pagination change', () => {
		const refetchMock = jest.fn();
		(useQuery as jest.Mock<UseQueryResult| any>).mockReturnValue({ // Fix incorrect typing and function call
			isLoading: false,
			isFetching: false,
			error: undefined,
			data: mockData,
			refetch: refetchMock,
		});

		render(<SearchResults postType="post" keyword="test" baseUrl="https://example.com" />);

		const paginator = document.querySelector('.ant-pagination-item-link');
		userEvent.click(paginator!);

		expect(refetchMock).toHaveBeenCalledWith();
	});

	(useQuery as jest.Mock<UseQueryResult | any >).mockReturnValue({ // Fix incorrect typing and function call
		isLoading: false,
		isFetching: false,
		error: undefined,
		data: mockData,
		refetch: jest.fn(),
	});

	it('should render exporter component when data is available', () => {
		const { getByText } = render(<SearchResults postType="post" keyword="test" baseUrl="https://example.com" />);

		expect(getByText(/Export/i)).toBeDefined();
	});

	it('should not render exporter component when no data is available', () => {
		(useQuery as jest.Mock<UseQueryResult | any >).mockReturnValueOnce({ // Fix incorrect typing and function call
			isLoading: false,
			isFetching: false,
			error: undefined,
			data: [],
			refetch: jest.fn(),
		});

	});
});
