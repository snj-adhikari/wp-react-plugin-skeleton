import React from 'react';
import WelcomePanel from '../components/WelcomePanel';


const App: React.FC = () => {

	return (
		<>
			<WelcomePanel
				title="Welcome to Wp Skeleton React Plugin"
				description="This is a plugin to help you find and replace keywords in your content."
			/>
		</>
	);
};
export default App;
