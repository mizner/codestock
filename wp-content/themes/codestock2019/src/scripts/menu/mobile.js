import { compose } from 'ramda';
import { ariaToggle } from '../utils/ariaToggle';
import { windowResizeWithThrottle } from '../utils/windowResizeWithThrottle';

export default () => {

  const menu = {
    button: document.getElementById('menuMainButton'),
    nav: document.getElementById('menuMain'),
    parents: [...document.querySelectorAll('.has-children')],
    widthMax: 1025,
    active: false,
    buttonMobileOnly: true,
  };

  const parentButtonEventHandler = (ev, item) => {
    ev.preventDefault();
    const subMenu = item.querySelector('ul');
    subMenu ? ariaToggle(subMenu, 'aria-expanded') : null;
  };

  const parentsButton = menu => {
    menu.parents.map(item => {
      const button = item.querySelector('.has-children__button');
      button.addEventListener('click', ev => parentButtonEventHandler(ev, item));
    });
    return menu;
  };

  const navButtonEventHandler = (ev, menu) => {
    ev.preventDefault();
    ariaToggle(menu.nav, 'aria-expanded');
    ariaToggle(menu.nav, 'aria-hidden', 'false');
    ariaToggle(menu.button, 'aria-expanded');
  };

  const navButton = menu => {
    if (document.body.scrollWidth > menu.widthMax) {
      return menu;
    }
    menu.button.addEventListener('click', ev => navButtonEventHandler(ev, menu));
    return menu;
  };

  const init = ev => {
    compose(
      parentsButton,
      navButton,
    )(menu);
  };

  document.addEventListener('DOMContentLoaded', ev => init(ev));
  windowResizeWithThrottle(init);

}