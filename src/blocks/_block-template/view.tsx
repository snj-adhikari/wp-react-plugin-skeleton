import React from 'react';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { BlockProps } from '../../helpers/types';


const Save = ( { attributes }: BlockProps ) => {
    const blockProps = useBlockProps.save();

	const { content }= (attributes as { [key: string]: any }).content;

    return (
        <RichText.Content { ...blockProps } tagName="p" value={ content } />
    );
};

export default Save;


