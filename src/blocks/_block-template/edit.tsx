import React from 'react';
import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { BlockProps } from '../../helpers/types';



const Edit = ( { attributes, setAttributes } : BlockProps ) => {

	const { content } = (attributes as { [key: string]: any }).content;
    const blockProps = useBlockProps();

    return (
        <RichText
            { ...blockProps }
            tagName="p"
            onChange={ ( updatedContent ) => setAttributes( { content: updatedContent } ) }
            value={ content }
            placeholder={ __( 'Write your content here...', 'my-block' ) }
        />
    );
};

export default Edit;
