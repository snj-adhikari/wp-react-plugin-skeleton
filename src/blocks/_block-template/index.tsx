import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import Edit from './edit';
import Save from './view';

import meta from './block.json';
import { BlockMeta } from '../../helpers/types';

const { name, title, icon, category, attributes, textdomain } = meta as BlockMeta;

// @ts-expect-error -> This a a wordpress function and we are using block name based on block.json.
registerBlockType( name, {
    title: __( title, textdomain ),
    icon: icon,
    category: category,
    attributes: attributes,
    edit: Edit,
    save: Save,
} );
