import fs from 'fs';
import path from 'path';

const directoryPath = './';

function includeSubfolderIndexFiles(directory: string) {
	const files = fs.readdirSync(directory);

	files.forEach((file) => {
		const filePath = path.join(directory, file);
		const stat = fs.statSync(filePath);

		if (stat.isDirectory()) {
			includeSubfolderIndexFiles(filePath);
		} else if (file === 'index.tsx') {
			// Include the index.tsx file here
			console.log(filePath);
			// You can write the file path to the index.ts file or perform any other operations
		}
	});
}

includeSubfolderIndexFiles(directoryPath);
