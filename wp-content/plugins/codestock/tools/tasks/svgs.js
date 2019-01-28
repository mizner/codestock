import pump from 'pump';
import { dest, src } from 'gulp';
import { paths } from '../utils/paths';
import svgo from 'gulp-svgo';

const svgoOptions = {
  removeViewBox: false
};

function svgs (cb) {

  return pump(
    [
      src(`${paths.src.svgs}/*.svg`),
      svgo(svgoOptions),
      dest(paths.dist.svgs),
    ],
    cb
  );

}

export { svgs };