//  eslint-disable-next-line @typescript-eslint/no-unused-vars
export type apiEndpointType = {
	method: string;
	name: string;
	prefix?: string;
	url?: string | null | undefined;
	body?: any;
	headers?: any;
};

export type QueryParamTypes = {
	per_page?: number;
	page?: number;
	search?: string;
	orderby?: string;
	order?: 'asc' | 'desc';
};


export interface SearchResultType {
	id: number;
	date: Date;
	title: {
		rendered: string;
	};
	content: {
		rendered: string;
	};
	excerpt: {
		rendered: string;
	};
	slug: string;
	link: string;
	count: number;
}

export interface QueryResult {
	data: SearchResultType[];
	header: any;
}

type PostData = {
	name: string;
	slug: string;
	rest_base: string;
};

export type PostTypeKey =
	| 'posts'
	| 'recipe'
	| 'review'
	| 'restaurant'
	| 'product'
	| 'pages'
	| 'post'
	| 'page';
export const postTypeKeys: PostTypeKey[] = [
	'post',
	'recipe',
	'review',
	'restaurant',
	'product',
	'page',
];

export const defaultType: PostTypeKey[] = ['posts', 'pages'];

type PostTypes = {
	[K in PostTypeKey]?: PostData;
};

export interface PostTypeResult {
	data: PostTypes;
	header: any;
}

export interface ErrorType {
	message: string;
}
