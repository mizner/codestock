import {pipe} from 'ramda'

const noop = () => ({});
const {domReady, blocks} = wp;
const {getBlockTypes, unregisterBlockType} = blocks;
const {whitelist} = manageBlocks;

const getBlacklist = (allowedBlocks, blockTypes) =>
    blockTypes.filter(({name}) =>
        allowedBlocks.indexOf(name) === -1);

domReady(() =>
    // getBlockTypes().map(item => console.log(item.name)) ||
    // console.log(whitelist) ||
    // console.log(getBlockTypes()) ||
    getBlacklist(whitelist, getBlockTypes()).map(({name}) =>
        unregisterBlockType(name)
    )
);