import React, { useState } from 'react';
import CustomTabs from '../components/CustomTabs';
import SearchFeature from '../components/SearchFeature';
import WelcomePanel from '../components/WelcomePanel';
import PostTypeSelector from '../components/PostTypeSelector';
import { defaultType, PostTypeKey } from '../helpers/types';

const App: React.FC = () => {
	const [postType, setPostType] = useState<PostTypeKey[]>(defaultType);
	const postTypeSelect = (value: PostTypeKey[]) => {
		setPostType(value);
	};

	const tabs = [
		{
			name: 'Keyword Finder',
			component: (
				<>
					<h4>Sample Search Feature</h4>
					<SearchFeature supportedPostTypes={postType} />
				</>
			),
		},
		{
			name: 'Keyword Replacer',
			component: (
				<>
					<h4>Keyword to replace</h4>
					<p>Coming soon</p>
				</>
			),
		},
	];

	return (
		<>
			<WelcomePanel
				title="Welcome to Wp Skeleton React Plugin"
				description="This is a plugin to help you find and replace keywords in your content."
			/>
			<div className="mx-1">
				<div>
					<span> Select Post Type : </span>
					<PostTypeSelector
						onSelect={postTypeSelect}
						defaults={defaultType}
					/>
				</div>
				<CustomTabs tabs={tabs} />
			</div>
		</>
	);
};
export default App;
