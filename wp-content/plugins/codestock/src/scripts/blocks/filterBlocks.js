/**
 * Leaving this file available for reference, but opting for handling at the server level via the filter 'allowed_block_types'
 */
const { domReady, blocks, hooks } = wp;
const { getBlockTypes, unregisterBlockType } = blocks;
const { whitelist } = manageBlocks;

const getBlacklist = (allowedBlocks, blockTypes) =>
  blockTypes.filter(({ name }) =>
    allowedBlocks.indexOf(name) === -1);

domReady(() =>
  // getBlockTypes().map(item => console.log(item.name)) ||
  // console.log(whitelist) ||
  // console.log(getBlockTypes()) ||
  // getBlacklist(whitelist, getBlockTypes()).map(({name}) =>
  //     unregisterBlockType(name)
  // )
  noop()
);