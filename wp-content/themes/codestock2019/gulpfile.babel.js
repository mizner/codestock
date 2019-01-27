import { series, parallel } from 'gulp';
import { scripts, styles, fonts, svgs, sprite, clean, monitor } from './tools/index';
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
  )
);

export { build, start, prod, styles, scripts, fonts, sprite };