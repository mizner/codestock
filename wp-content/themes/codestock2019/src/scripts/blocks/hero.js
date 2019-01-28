import { countdown } from '../features/countdown';

function hero () {
  countdown('#countdown', {
    startDate: new Date(2019, 3, 12),
    endDate: null
  });
}

export { hero };