
# Check if the destination directory is provided
if [ -z "$1" ]; then
  echo "Usage: $0 <destination>"
  exit 1
fi

# Define the path to the .deployignore file
DEPLOYIGNORE_FILE=".deployignore"

# Check if the .deployignore file exists
if [ ! -f "$DEPLOYIGNORE_FILE" ]; then
  echo "Error: $DEPLOYIGNORE_FILE file not found!"
  exit 1
fi

# Run rsync with the --exclude-from option
rsync -avz --exclude-from="$DEPLOYIGNORE_FILE" "$(pwd)/" "$1"
