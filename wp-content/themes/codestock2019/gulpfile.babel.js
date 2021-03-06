import { series, parallel } from 'gulp';
import { scripts, styles, fonts, images, svgs, sprite, clean, monitor } from './tools/index';
import { serve } from './tools/tasks/serve';

const start = parallel(
  serve,
  monitor
);

const build = series(
  clean,
  series(
    styles,
    scripts,
    fonts,
    svgs,
    sprite,
    images,
  )
);

const prod = series(
  clean,
  parallel(
    scripts,
    styles,
    fonts,
    svgs,
    sprite,
    images
  )
);

export { build, start, prod, styles, scripts, fonts, sprite, images };