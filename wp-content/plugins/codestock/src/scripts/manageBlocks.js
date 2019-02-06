import { pipe } from 'ramda';
import { registerBlocks } from './blocks';

pipe(
  registerBlocks
)();