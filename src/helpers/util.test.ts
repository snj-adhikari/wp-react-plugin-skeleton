import { retrieveUrlsFromElement } from './util'; // replace with actual path

describe('retrieveUrlsFromElement', () => {
    it('retrieves all URLs from a specific HTML element', () => {
        document.body.innerHTML = `
            <div id="test">
                <a href="http://link1.com">Link 1</a>
                <a href="http://link2.com">Link 2</a>
            </div>
        `;

        const urls = retrieveUrlsFromElement('test');

        expect(urls).toEqual(['http://link1.com/', 'http://link2.com/']);
    });

    it('returns an empty array if the element does not exist', () => {
        const urls = retrieveUrlsFromElement('nonexistent');

        expect(urls).toEqual([]);
    });
});
