import React from 'react';
import { useQuery } from 'react-query';
import { Select, Spin } from 'antd';
import { sendGetRequest } from '../helpers/api';
import {
	ErrorType,
	PostTypeResult,
	defaultType,
	postTypeKeys,
	PostTypeKey,
} from '../helpers/types';
import { defaultSite, getApiEndpoint, getUrlForSite } from '../helpers/conf';

interface PostTypeSelectorProps {
	onSelect: (value: PostTypeKey[]) => void;
	baseUrl?: string;
	defaults?: PostTypeKey[];
}

const PostTypeSelector = ({
	onSelect,
	baseUrl = getUrlForSite(defaultSite),
	defaults = defaultType,
}: PostTypeSelectorProps) => {
	const POST_TYPE_URL = getApiEndpoint('post_types', baseUrl);
	const { data: postInfo, isLoading } = useQuery<PostTypeResult, ErrorType>(
		'postTypes',
		() => sendGetRequest(POST_TYPE_URL)
	);

	if (isLoading) {
		return <Spin />;
	}

	const { data: postTypes } = postInfo || {};
	return (
		<Select
			mode="multiple"
			onChange={onSelect}
			style={{ width: '500px', minWidth: '200px' }}
			defaultValue={defaults}
			placeholder="Select post types"
			className="ml-2 mr-2"
		>
			{postTypes &&
				postTypeKeys.map((key) => {
					if (postTypes && postTypes[key]) {
						const currentPostType = postTypes[key];
						return (
							<Select.Option
								key={key}
								value={currentPostType?.rest_base ?? ''}
							>
								{currentPostType?.name ?? ''}
							</Select.Option>
						);
					}
				})}
		</Select>
	);
};

export default PostTypeSelector;
