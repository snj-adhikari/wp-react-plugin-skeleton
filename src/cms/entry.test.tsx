import { render } from '@testing-library/react';
import { QueryClient, QueryClientProvider } from 'react-query';
import Index from './entry'; // replace with actual path
import React from 'react';

jest.mock('./app', () => () => <div>App</div>); // Mock the App component

describe('Index', () => {
    it('renders correctly', () => {
        const { getByText } = render(
            <QueryClientProvider client={new QueryClient()}>
                <Index />
            </QueryClientProvider>
        );

        expect(getByText('App')).toBeDefined();
    });
});
