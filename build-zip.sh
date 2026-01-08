#!/bin/bash

# Configuration
PLUGIN_DIR="accordion-hero-slider"
OUTPUT_DIR="releases"
VERSION=$(grep "Version:" $PLUGIN_DIR/accordion-hero-slider.php | awk '{print $NF}')
ZIP_NAME="accordion-hero-slider.zip"
VERSIONED_ZIP_NAME="accordion-hero-slider-v$VERSION.zip"

# Create output directory if it doesn't exist
mkdir -p $OUTPUT_DIR

# Remove old zips
rm -f $OUTPUT_DIR/*.zip

# Create the zip file
# Exclude git files and any other unnecessary local files
zip -r $OUTPUT_DIR/$ZIP_NAME $PLUGIN_DIR -x "*.DS_Store*" "*.git*" "*/README.md"

# Create a versioned copy
cp $OUTPUT_DIR/$ZIP_NAME $OUTPUT_DIR/$VERSIONED_ZIP_NAME

echo "✅ Build Complete!"
echo "📍 Main ZIP: $OUTPUT_DIR/$ZIP_NAME"
echo "📍 Versioned ZIP: $OUTPUT_DIR/$VERSIONED_ZIP_NAME"
