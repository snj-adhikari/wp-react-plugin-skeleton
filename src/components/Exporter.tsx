import React, { useState } from 'react';
import { decode } from 'html-entities';
import { useQueryClient } from 'react-query';
import { Button, Modal, Progress } from 'antd';
import { sendGetRequest } from '../helpers/api';
import { QueryParamTypes } from '../helpers/types';
import { defaultSite, getApiEndpoint, replacePostId } from '../helpers/conf';

interface ExporterProps {
	queryKey: string;
	exportKeys: string[];
	url: string;
	params: QueryParamTypes;
	totalPages: number;
	fileName?: string;
	baseUrl?: string;
}

const Exporter: React.FC<ExporterProps> = ({
	queryKey,
	url,
	params,
	fileName = 'data_export_csv',
	totalPages,
	exportKeys = [],
	baseUrl = defaultSite,
}) => {
	const [exporting, setExporting] = useState(false);
	const [progress, setProgress] = useState(0);
	const queryClient = useQueryClient();

	const exportData = async () => {
		setExporting(true);

		const allData = [];
		let page = 1;
		while (page <= totalPages) {
			const { data: infoData } = await queryClient.fetchQuery(
				[queryKey, page],
				() => sendGetRequest(url, { ...params, page })
			);

			if (!infoData || infoData.length === 0) break;
			allData.push(
				...infoData.map((item: any) => {
					// Explicitly type 'item' as any[]
					const selectedData: { [key: string]: any } = {}; // Add index signature to allow indexing with a string key
					const renderElem = ['title', 'excerpt', 'content']; // Add your selected exportKeys here as an array
					exportKeys.forEach((key) => {
						if (key === 'edit_link' && Object.prototype.hasOwnProperty.call(item, 'id')) {
							selectedData.edit_link = replacePostId(
								getApiEndpoint('admin_edit_url', baseUrl),
								item.id
							);
						} else if (Object.prototype.hasOwnProperty.call(item, key)) {
							if (
								renderElem.includes(key) &&
								item[key].rendered
							) {
								selectedData[key] = decode(item[key].rendered);
							} else {
								selectedData[key] = item[key];
							}
						} else {
							// do nothing
						}
						const value = selectedData[key];
						selectedData[key] =
							typeof value === 'string' && value.includes(',')
								? `"${value}"`
								: value;
					});

					return selectedData;
				})
			);
			setProgress(parseFloat(((page / totalPages) * 100).toFixed(2)));
			page++;
		}

		const header = exportKeys.join(',');
		const csv = `${header}\n${allData.map((row) => Object.values(row).join(',')).join('\n')}`;
		const csvData = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
		const csvUrl = URL.createObjectURL(csvData);

		const link = document.createElement('a');
		link.href = csvUrl;
		link.download = `${fileName}.csv`;
		link.click();

		setExporting(false);
	};

	return (
		<div>
			<Button onClick={exportData} disabled={exporting}>
				{exporting ? 'Exporting...' : 'Export to CSV'}
			</Button>
			<Modal
				title="Exporting Data"
				open={exporting}
				footer={null}
				closable={false}
			>
				<Progress percent={progress} />
			</Modal>
		</div>
	);
};

export default Exporter;
