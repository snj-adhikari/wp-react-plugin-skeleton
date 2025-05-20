/* eslint-disable no-console */
/* eslint-disable @typescript-eslint/explicit-function-return-type */
/* global console */

import fs from 'fs';
import { exec } from 'child_process';

const { version: packageVersion } = JSON.parse(
	fs.readFileSync('package.json', 'utf8')
);

function getComposerVersion() {
	const composerJson = JSON.parse(fs.readFileSync('composer.json', 'utf8'));
	return composerJson.version;
}

function getPluginVersion() {
	const pluginFileContent = fs.readFileSync('njw-skeleton-react-plugin.php', 'utf8');
	const match = pluginFileContent.match(/Version: (\d+\.\d+\.\d+)/);
	return match ? match[1] : null;
}

let versionUpdated = false;

// Step 2: Update composer.json if version is different
const composerVersion = getComposerVersion();
if (composerVersion !== packageVersion) {
	let composerFileContent = fs.readFileSync('composer.json', 'utf8');
	composerFileContent = composerFileContent.replace(
		/("version"\s*:\s*")\d+\.\d+\.\d+(")/,
		`$1${packageVersion}$2`
	);
	fs.writeFileSync('composer.json', composerFileContent);
	console.log(`Version updated to ${packageVersion} in composer.json.`);
	versionUpdated = true;
} else {
	console.log(
		`Version update not needed in composer.json. Current version: ${composerVersion}.`
	);
}

// Step 3: Update njw-skeleton-react-plugin.php if version is different
const pluginVersion = getPluginVersion();
if (pluginVersion !== packageVersion) {
	let pluginFileContent = fs.readFileSync('njw-skeleton-react-plugin.php', 'utf8');
	pluginFileContent = pluginFileContent.replace(
		/Version: \d+\.\d+\.\d+/,
		`Version: ${packageVersion}`
	);
	fs.writeFileSync('njw-skeleton-react-plugin.php', pluginFileContent);
	console.log(
		`Version updated to ${packageVersion} in njw-skeleton-react-plugin.php.`
	);
	versionUpdated = true;
} else {
	console.log(
		`Version update not needed in njw-skeleton-react-plugin.php. Current version: ${pluginVersion}.`
	);
}

// Function to check if the versions match
function checkVersions() {
	const updatedPackageLockVersion = JSON.parse(
		fs.readFileSync('package-lock.json', 'utf8')
	).version;
	const updatedComposerVersion = JSON.parse(
		fs.readFileSync('composer.json', 'utf8')
	).version;
	const pluginFileContent = fs.readFileSync('njw-skeleton-react-plugin.php', 'utf8');
	const pluginVersionMatch = pluginFileContent.match(
		/Version: (\d+\.\d+\.\d+)/
	);
	const updatedPluginVersion = pluginVersionMatch
		? pluginVersionMatch[1]
		: null;

	if (
		[
			updatedPackageLockVersion,
			updatedComposerVersion,
			updatedPluginVersion,
		].some((version) => version !== packageVersion)
	) {
		console.error(
			`Error: One or more versions do not match package.json version (${packageVersion}).`
		);
	} else {
		console.log(
			`Success: All versions match package.json version ${packageVersion}.`
		);
	}
}

// Run npm install if version was updated
if (versionUpdated) {
	console.log('Running npm install to update package-lock.json...\n');
	exec('npm install', { stdio: 'inherit' }, (error) => {
		if (error) {
			console.error(`Error running npm install: ${error.message}`);
			return;
		}
		console.log('npm install completed successfully.\n');
		checkVersions();
	});
}
