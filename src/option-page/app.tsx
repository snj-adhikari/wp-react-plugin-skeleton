import React, { useState } from 'react';
import { TextControl, Button } from '@wordpress/components';

import { useQuery } from 'react-query';
import { fetchPosts } from './helpers/api';

const App: React.FC = () => {
	const [inputValue, setInputValue] = useState('');
	const handleInputChange = (value: string) => {
		setInputValue(value);
	};
	const handleSave = () => {
		// Save the input value
		console.log('Input value:', inputValue);
	};

	const { data: posts, isLoading, isError } = useQuery('posts', fetchPosts);

	if (isLoading) {
		return <div>Loading...</div>;
	}

	if (isError) {
		return <div>Error loading posts</div>;
	}

	return (
		<div>
			<h1>Plugin Page Settings</h1>
			<TextControl
				label="Sample Text Input"
				value={inputValue}
				onChange={handleInputChange}
			/>
			<Button onClick={handleSave}>Save</Button>

			<h2>Posts</h2>
			{posts.map((post: any) => (
				<div key={post.id}>{post.title}</div>
			))}
		</div>
	);
};
export default App;
