import { paths } from '../utils/paths';
import { src, dest } from 'gulp';
import pump from 'pump';

function vendors (cb) {
  return pump(
    [
      src([
        `${paths.root}/node_modules/react/umd/react.production.min.js`,
        `${paths.root}/node_modules/react-dom/umd/react-dom.production.min.js`
      ]),
      dest(`${paths.root}/dist/vendors`),
    ],
    cb
  );
}

export { vendors };