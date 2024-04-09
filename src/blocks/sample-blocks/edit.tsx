import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import React from 'react';

export default function Edit() {
	const blockProps = useBlockProps();

	return (
		<div {...blockProps}>
			<p>{ __( 'Edit me!', 'sample-block' ) }</p>
		</div>
	);
}
