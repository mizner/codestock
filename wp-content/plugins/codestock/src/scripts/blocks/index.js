import { pipe } from 'ramda';
import { Section } from './Section/Section';

const registerBlocks = () => pipe(
  Section
)();

export { registerBlocks };