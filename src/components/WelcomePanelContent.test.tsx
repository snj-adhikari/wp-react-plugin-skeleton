import { render } from '@testing-library/react';
import React from 'react';
import WelcomePanelContent from './WelcomePanelContent'; // replace with actual path

describe('WelcomePanelContent', () => {
    it('renders correctly', () => {
        const columns = [
            { heading: 'Heading 1', content: 'Content 1', icon: 'icon1', link: 'http://link1.com', linkText: 'Link 1' },
            { heading: 'Heading 2', content: 'Content 2', icon: 'icon2', link: 'http://link2.com', linkText: 'Link 2' },
        ];

        const { getByText, getByRole } = render(<WelcomePanelContent columns={columns} />);

        columns.forEach(column => {
            expect(getByText(column.heading)).toBeDefined();
            expect(getByText(column.content)).toBeDefined();
			const linkElement = getByRole('link', { name: column.linkText });

			expect(linkElement.getAttribute('href')).toBe(column.link);
        });
    });
});
