# React Plugin Skeleton for WordPress

This is a skeleton React app plugin for WordPress, built using TypeScript.

## Installation

1. Clone the repository:

	```bash
	git clone https://github.com/snj-adhikari/wp-react-plugin-skeleton.git
	```

2. Install the dependencies:

	```bash
	npm install
	```

## Usage
-  Using react within wordpess using custom plugin.

## Available Scripts

In the project directory, you can run:

### `npm start`

Runs the app in the development mode. The page will reload if you make edits. You will also see any lint errors in the console.

### `npm run build`

Builds the app for production to the `build` folder. It correctly bundles React in production mode and optimizes the build for the best performance.

### `npm run create:block`

This command navigates to the `./src/blocks` directory and creates a new WordPress block using the `@wordpress/create-block` package. The `--no-plugin` option tells it to only generate the block files, not the entire plugin structure. The `--template njw-wp-typescript-block` option specifies that it should use the `njw-wp-typescript-block` template for the block.
