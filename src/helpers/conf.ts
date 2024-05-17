import { apiEndpointType } from './types';

export const elementId = 'page-content';

export const defaultReactQueryOption = {
	queries: {
		refetchOnWindowFocus: false,
		refetchOnmount: false,
		refetchOnReconnect: true,
		retry: 1,
		staleTime: 5 * 60 * 1000,
		retryDelay: 30000,
	},
};

export const apiEndpoint: apiEndpointType[] = [
	{
		method: 'GET',
		name: 'post_url',
		prefix: '/wp-json/wp/v2/posts',
	},
	{
		method: 'GET',
		name: 'post_types',
		prefix: '/wp-json/wp/v2/types',
	},
	{
		method: 'GET',
		name: 'dynamic_post_type_url',
		prefix: '/wp-json/wp/v2/<post_type>',
	},
	{
		method: 'GET',
		name: 'admin_edit_url',
		prefix: '/wp-admin/post.php?post=<post_id>&action=edit',
	},
];

// Define the list of URLs with site names
export const siteUrls = [
	{ siteName: 'Current', url: window.location.origin },
	{ siteName: 'Not Just Web', url: 'https://www.notjustweb.com/' },
	{ siteName: 'test', url: 'https://www.test.com.au/' },
];

export const defaultSite = 'Current';

// Function to get the URL for a given site name
export const getUrlForSite = (siteName: string): string => {
	const site = siteUrls.find((item) => item.siteName === siteName);
	return site ? site.url : window.location.origin;
};

export const getApiEndpoint = (name: string, baseUrl: string) => {
	const endpoint = apiEndpoint.find((cEnd) => cEnd.name === name);
	return baseUrl + endpoint?.prefix;
};

export const replaceUrl = (url: string, search: string, replace: string) => {
	return url.replace(search, replace);
};

export const replacePostType = (url: string, postType: string) => {
	return replaceUrl(url, '<post_type>', postType);
};

export const replacePostId = (url: string, postId: number) => {
	return replaceUrl(url, '<post_id>', postId.toString());
};
