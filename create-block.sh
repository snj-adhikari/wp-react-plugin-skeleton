#!/bin/bash

# Prompt the user for the block name
read -p "Enter the block name: " BLOCK_NAME

# Check if block name is provided
if [ -z "$BLOCK_NAME" ]; then
  echo "Block name is required."
  exit 1
fi

# Prompt the user for the block title
read -p "Enter the block title: " BLOCK_TITLE

# Check if block title is provided
if [ -z "$BLOCK_TITLE" ]; then
  echo "Block title is required."
  exit 1
fi

# Prompt the user for the block description
read -p "Enter the block description: " BLOCK_DESCRIPTION

TEMPLATE_DIR="./src/blocks/_block-template"
BLOCK_DIR="./src/blocks/$BLOCK_NAME"

# Check if block directory already exists
if [ -d "$BLOCK_DIR" ]; then
  echo "Block \"$BLOCK_NAME\" already exists."
  exit 1
fi

# Create the new block directory
mkdir -p "$BLOCK_DIR"

# Copy template files to the new block directory
cp -r "$TEMPLATE_DIR/." "$BLOCK_DIR"

# Update block.json with the new block name, title, and description
BLOCK_JSON="$BLOCK_DIR/block.json"
jq --arg name "aredeals/$BLOCK_NAME" --arg title "$BLOCK_TITLE" --arg description "$BLOCK_DESCRIPTION" \
  '.name = $name | .title = $title | .description = $description' "$BLOCK_JSON" > "$BLOCK_JSON.tmp" && mv "$BLOCK_JSON.tmp" "$BLOCK_JSON"

# Add import statement to src/blocks/index.ts
echo  "\nimport './$BLOCK_NAME/index';" >> ./src/blocks/index.ts

echo "Block \"$BLOCK_NAME\" created successfully."
