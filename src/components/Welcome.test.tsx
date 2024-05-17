import React from 'react';
import { render, screen } from '@testing-library/react';
import WelcomePanel from './WelcomePanel';

describe('WelcomePanel component', () => {
  it('should render title and description', () => {
    const title = 'Test Title';
    const description = 'Test Description';

    render(<WelcomePanel title={title} description={description} />);

    expect(screen.getByText(title)).toBeDefined();
    expect(screen.getByText(description)).toBeDefined();
  });
});
