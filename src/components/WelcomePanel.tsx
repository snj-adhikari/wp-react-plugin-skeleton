import React from 'react';

interface WelcomePanelProps {
	title: string;
	description: string;
}

const WelcomePanel: React.FC<WelcomePanelProps> = ({ title, description }) => {
	return (
		<div id="welcome-panel" className="welcome-panel mr-2">
			<div className="welcome-panel-content">
				<div className="welcome-panel-header">
					<h2>{title}</h2>
					<p>{description}</p>
				</div>
			</div>
		</div>
	);
};

export default WelcomePanel;
