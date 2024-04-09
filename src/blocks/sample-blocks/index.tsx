import { registerBlockType } from '@wordpress/blocks';
import edit from './edit';
import save from './save';

registerBlockType( 'sample-block/sample-block', {
	title: 'Sample Block',
	icon: 'smiley',
	category: 'common',
	attributes: {},
	edit,
	save,
});
