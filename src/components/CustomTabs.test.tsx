import CustomTabs from './CustomTabs';
import React from 'react';
import {  render } from '@testing-library/react';

describe('CustomTabs', () => {
	it('renders correctly', () => {
		const tabs = [
			{ name: 'Tab 1', component: <div>Tab 1 content</div> },
			{ name: 'Tab 2', component: <div>Tab 2 content</div> },
		];

		const { getByText, queryByText } = render(<CustomTabs tabs={tabs} />);

		tabs.forEach((tab, index) => {
			expect(getByText(tab.name)).toBeDefined();
			if (index === 0) {
				// The first tab should be active, so its content should be in the document
				expect(getByText(tab.component.props.children)).toBeDefined();
			} else {
				// The other tabs should not be active, so their content should not be in the document
				expect(queryByText(tab.component.props.children, { exact: false })).toBeNull();
			}
		});
	});
});
