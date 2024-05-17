import { getUrlForSite, getApiEndpoint, replaceUrl, replacePostType, replacePostId } from './conf'; // replace with actual path

describe('Utility functions', () => {
    it('gets the URL for a given site name', () => {
        const siteName = 'test';
        const url = getUrlForSite(siteName);

        expect(url).toBe('https://www.test.com.au/'); // replace with the expected URL
    });

    it('gets the API endpoint for a given name', () => {
        const name = 'post_types';
        const baseUrl = 'http://base.com';
        const endpoint = getApiEndpoint(name, baseUrl);

        expect(endpoint).toBe('http://base.com/wp-json/wp/v2/types'); // replace with the expected endpoint
    });

    it('replaces a part of the URL', () => {
        const url = 'http://test.com/<replace_me>';
        const search = '<replace_me>';
        const replace = 'replaced';
        const newUrl = replaceUrl(url, search, replace);

        expect(newUrl).toBe('http://test.com/replaced');
    });

    it('replaces the post type in the URL', () => {
        const url = 'http://test.com/<post_type>';
        const postType = 'post';
        const newUrl = replacePostType(url, postType);

        expect(newUrl).toBe('http://test.com/post');
    });

    it('replaces the post ID in the URL', () => {
        const url = 'http://test.com/<post_id>';
        const postId = 123;
        const newUrl = replacePostId(url, postId);

        expect(newUrl).toBe('http://test.com/123');
    });
});
