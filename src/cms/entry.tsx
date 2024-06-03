import React from 'react';
import { QueryClient, QueryClientProvider } from 'react-query';
import App from './app';

const queryClient = new QueryClient();

const Index: React.FC = () => {
	return (
		<QueryClientProvider client={queryClient}>
			<App />
		</QueryClientProvider>
	);
};

export default Index;



