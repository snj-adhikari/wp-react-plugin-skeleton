import { render } from '@testing-library/react';
import PostTypeSelector from './PostTypeSelector'; // replace with actual path
import React from 'react';
import { PostTypeKey } from '../helpers/types';


jest.mock('react-query', () => ({
	useQuery: jest.fn().mockReturnValue({
		data: {
			data: {
				post: { rest_base: 'post', name: 'Post' },
				page: { rest_base: 'page', name: 'Page' },
			},
		},
		isLoading: false,
	}),
	QueryClient: jest.fn(() => ({
		// Mock any methods of QueryClient that you use
	})),
}));

test('it should select post types', async () => {
	// const queryClient = new QueryClient();

	const defaults = ['post', 'page'] as PostTypeKey[];
	const onSelect = jest.fn();
	const { getByText } = render(
		<PostTypeSelector onSelect={onSelect}  defaults={defaults} />
	);

	expect(getByText('Post')).toBeDefined();
});
