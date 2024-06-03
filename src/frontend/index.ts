

// Replace the URLs on the anchor tags with the transformed URL
import { retrieveUrlsFromElement } from "../helpers/util";
import { sendPostRequest } from "../helpers/api";
import { elementId, getApiEndpoint } from "./conf";

const urls = retrieveUrlsFromElement(elementId);

const sample_api = getApiEndpoint('sample_post') || { url: '' };
// Send a POST request to the server to get the transformed URLs
const transformedUrlsResponse = await sendPostRequest(sample_api?.url ? sample_api.url : '', { urls });

// Extract the transformed URLs from the response
const transformedUrls = transformedUrlsResponse.data;

// Replace the URLs on the anchor tags with the transformed URLs
const anchorTags = document.getElementById(elementId)?.getElementsByTagName('a');
if (anchorTags) {
	for (let i = 0; i < anchorTags.length; i++) {
		const anchorTag = anchorTags[i];
		const url = anchorTag.getAttribute('href');
		if (url && transformedUrls[url]) {
			anchorTag.setAttribute('href', transformedUrls[url]);
		}
	}
}

