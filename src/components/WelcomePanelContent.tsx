import React from 'react';

type Column = {
	heading: string;
	content: string;
	icon: string;
	link: string;
	linkText: string;
};

type WelcomePanelContentProps = {
	columns: Column[];
};

const WelcomePanelContent: React.FC<WelcomePanelContentProps> = ({
	columns,
}) => {
	return (
		<div className="welcome-panel-column-container">
			{columns.map((column, index) => (
				<div className="welcome-panel-column" key={index}>
					<span
						className={`dashicons dashicons-${column.icon}`}
					></span>
					<div className="welcome-panel-column-content">
						<h3>{column.heading}</h3>
						<p>{column.content}</p>
						<a href={column.link}>{column.linkText}</a>
					</div>
				</div>
			))}
		</div>
	);
};

export default WelcomePanelContent;
