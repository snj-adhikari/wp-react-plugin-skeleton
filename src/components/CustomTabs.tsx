import React from 'react';
import { Tabs } from 'antd';


interface TabProps {
	tabs: { name: string; component: React.ReactNode }[];
}

const CustomTabs: React.FC<TabProps> = ({ tabs }) => {
	const items = tabs.map((tab, index) => ({
		key: index.toString(),
		tab: tab.name,
		label: tab.name,
		children: tab.component,
	}));
	return (
		<div className="mr-2">
			<Tabs items={items}/>
		</div>
	);
};

export default CustomTabs;
