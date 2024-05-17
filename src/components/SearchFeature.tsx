import React, { useState } from 'react';
import { PostTypeKey, defaultType } from '../helpers/types';
import SearchResults from './SearchResults';
import { defaultSite, getUrlForSite } from '../helpers/conf';
import { Input } from 'antd';
import type { SearchProps } from 'antd/es/input/Search';

const { Search } = Input;

type SearchFeatureProps = {
	supportedPostTypes?: PostTypeKey[];
};

const SearchFeature: React.FC<SearchFeatureProps> = ({
	supportedPostTypes = defaultType,
}) => {
	const [searchTerm, setSearchTerm] = useState<string>('');
	const [resultInitiate, setResultInitiate] = useState<boolean>(false);

	const baseUrl = getUrlForSite(defaultSite);

	const onSearch: SearchProps['onSearch'] = (value) => {
		setSearchTerm(value);
		setResultInitiate(true);
	};

	return (
		<div className="search-box">
			<Search
				placeholder="input search text"
				allowClear
				enterButton="Search"
				size="large"
				onSearch={onSearch}
			/>
			{supportedPostTypes &&
				resultInitiate &&
				supportedPostTypes.map((postType, index) => (
					<SearchResults
						key={index}
						keyword={searchTerm}
						postType={postType}
						baseUrl={baseUrl}
					/>
				))}
		</div>
	);
};

export default SearchFeature;
