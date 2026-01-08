# Accordion Hero Slider - Project Repository

This repository contains the source code for the **Accordion Hero Slider** Elementor widget.

## 📂 Repository Structure

- `accordion-hero-slider/`: The main plugin source code.
- `.github/workflows/`: GitHub Actions for automated builds and releases.
- `releases/`: (Automated) Directory where the latest plugin ZIP files are stored.
- `build-zip.sh`: Shell script to manually package the plugin.

## 🛠 For Developers

### Building the Plugin
To package the plugin into a ZIP file locally, run:
```bash
./build-zip.sh
```
This will create `releases/accordion-hero-slider.zip`.

### GitHub Actions
- **PR Build**: Every Pull Request automatically generates a versioned ZIP file for testing.
- **Release**: Merging to `main` (or pushing a tag) will automatically create a new GitHub Release with the plugin ZIP attached.

## 📝 License
Licensed under GPL v2 or later.
