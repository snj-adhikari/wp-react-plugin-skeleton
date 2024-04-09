import { useBlockProps } from '@wordpress/block-editor';
import React from 'react';

export default function Save() {
	const blockProps = useBlockProps.save();

	return (
		<div {...blockProps}>
			<p>Content goes here.</p>
		</div>
	);
}
