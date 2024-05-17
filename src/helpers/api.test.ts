import { sendGetRequest } from './api'; // replace with actual path

describe('sendGetRequest', () => {
    it('sends a GET request and returns the response data and headers', async () => {
		const mockData = { key: 'value' };
		const mockHeaders = new Headers({ 'Content-Type': 'application/json' });

		global.fetch = jest.fn(() =>
			Promise.resolve({
				json: () => Promise.resolve(mockData),
				headers: mockHeaders,
			}) as Promise<Response>
		);

		const url = 'http://test.com';
		const query = { search: 'test' };
		const headers = { 'Authorization': 'Bearer token' };

		const result = await sendGetRequest(url, query, headers);

        expect(global.fetch).toHaveBeenCalledWith(`${url}?search=test`, {
            method: 'GET',
            headers: {
                ...headers,
                'Content-Type': 'application/json',
            },
        });
        expect(result).toEqual({ data: mockData, header: mockHeaders });
    });
});
