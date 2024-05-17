import React from 'react';
import { render, fireEvent } from '@testing-library/react';
import SearchFeature from './SearchFeature'; // replace with actual path

jest.mock('./SearchResults', () => () => <div>SearchResults</div>); // Mock the SearchResults component

describe('SearchFeature', () => {
    it('renders correctly', () => {
        const { getByPlaceholderText, queryByText } = render(<SearchFeature />);

        expect(getByPlaceholderText('input search text')).toBeDefined();
        expect(queryByText('SearchResults')).toBeNull();
    });

    it('initiates search on search term input', () => {
        const { getByPlaceholderText, getByText, getAllByText } = render(<SearchFeature />);

        fireEvent.change(getByPlaceholderText('input search text'), { target: { value: 'test' } });
        fireEvent.click(getByText('Search'));

        expect(getAllByText('SearchResults')).toBeDefined();
    });
});
