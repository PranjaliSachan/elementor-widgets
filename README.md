# Custom Elementor Widgets Repository

This repository is a collection of premium, high-fidelity custom widgets for **Elementor**. Each widget is built as a standalone WordPress plugin for maximum portability and ease of use.

## 📂 Repository Structure

- `accordion-hero-slider/`: A premium horizontal accordion hero slider with industry-focused design.
- `.github/workflows/`: GitHub Actions for automated builds and releases.
- `releases/`: (Automated) Directory where the latest plugin ZIP files are stored.
- `build-zip.sh`: Shell script to manually package specific widgets.

## 🛠 For Developers

### Building a Widget
To package a specific widget into a ZIP file locally, run the build script. By default, it targets the `accordion-hero-slider`.
```bash
./build-zip.sh
```

### GitHub Actions
- **PR Build**: Every Pull Request automatically generates versioned ZIP files for the modified widgets.
- **Release**: Merging to `main` (or pushing a version tag like `v*`) will automatically create a new GitHub Release with the corresponding plugin ZIP attached.

## 📝 License
All widgets in this repository are licensed under GPL v2 or later.
