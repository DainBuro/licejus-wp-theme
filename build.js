const esbuild = require("esbuild");
const { sassPlugin } = require("esbuild-sass-plugin");
const path = require("path");

// Check if we're in production mode
const isProduction = process.env.NODE_ENV === "production";

// Check if watch mode is enabled
const isWatch = process.argv.includes("--watch");

// Common esbuild options
const commonOptions = {
  bundle: true,
  sourcemap: !isProduction,
  // Outputs are named *.min.*; keep them minified in both dev and prod.
  // Source maps remain enabled in dev for debugging.
  minify: true,
  // Strip banner/license comments from outputs.
  legalComments: "none",
  target: ["es2020", "chrome90", "firefox88", "safari14"],
  logLevel: "info",
};

// JavaScript build options
const jsOptions = {
  ...commonOptions,
  entryPoints: ["src/js/main.js"],
  outfile: "assets/js/main.min.js",
  format: "iife",
  platform: "browser",
};

// SCSS build options
const scssOptions = {
  ...commonOptions,
  // Sass already resolves @use/@import. Disabling bundling prevents esbuild from
  // rewriting/copying assets referenced via url() (e.g. fonts in assets/fonts).
  bundle: false,
  entryPoints: ["src/scss/main.scss"],
  outfile: "assets/css/main.min.css",
  plugins: [
    sassPlugin({
      loadPaths: [path.resolve(__dirname, "src/scss")],
    }),
  ],
};

// Build function
async function build() {
  try {
    if (isWatch) {
      console.log("Starting watch mode...\n");

      // Create contexts for watching
      const jsContext = await esbuild.context(jsOptions);
      const scssContext = await esbuild.context(scssOptions);

      // Start watching
      await jsContext.watch();
      await scssContext.watch();

      console.log("Watching for changes:");
      console.log("  JS:   src/js/main.js -> assets/js/main.min.js");
      console.log("  SCSS: src/scss/main.scss -> assets/css/main.min.css");
      console.log("\nPress Ctrl+C to stop.\n");

      // Keep the process running
      process.on("SIGINT", async () => {
        console.log("\n\nStopping watch mode...");
        await jsContext.dispose();
        await scssContext.dispose();
        process.exit(0);
      });
    } else {
      console.log(
        `Building ${isProduction ? "production" : "development"} assets...\n`,
      );

      await Promise.all([esbuild.build(jsOptions), esbuild.build(scssOptions)]);

      console.log("\nBuild complete:");
      console.log("  JS:  assets/js/main.min.js");
      console.log("  CSS: assets/css/main.min.css");
    }
  } catch (error) {
    console.error("Build failed:", error);
    process.exit(1);
  }
}

// Run build
build();
