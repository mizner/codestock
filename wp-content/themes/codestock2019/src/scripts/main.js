import { pipe } from 'ramda';
import mobileMenu from './menu/mobile';
import { hero } from './blocks/hero';

console.log('main');
pipe(
  mobileMenu,
  hero,
)();