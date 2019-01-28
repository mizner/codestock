// This could probably use a little cleanup

import countdownJS from 'countdown';

function getCountdownInterval (start, end) {
  return countdownJS(
    start,
    end,
    countdownJS.DAYS | countdownJS.HOURS | countdownJS.MINUTES | countdownJS.SECONDS,
    5,
    0
  );
}

function countdownRender (element, countdownObject) {
  const { months, days, hours, minutes, seconds } = countdownObject;

  const twoDigits = int => 9 < int ? int : `0${int}`;

  element.innerHTML    = `
        <span class="countdown__item days"><span class="countdown__value">${twoDigits(days)}</span> <span class="countdown__type">Days</span></span>
        <span class="countdown__item hours"><span class="countdown__value">${twoDigits(hours)}</span> <span class="countdown__type">Hours</span></span>
        <span class="countdown__item minutes"><span class="countdown__value">${twoDigits(minutes)}</span> <span class="countdown__type">Minutes</span></span>
        <span class="countdown__item seconds"><span class="countdown__value">${twoDigits(seconds)}</span> <span class="countdown__type">Seconds</span></span>
        `;
}

function countdown (selector, options = {}) {
  const anchor = document.querySelector(selector);

  const {
    // Destructure and set defaults
    startDate = new Date(2000, 2, 2),
    endDate   = null
  } = options;

  // Initial Run
  countdownRender(
    anchor,
    getCountdownInterval(
      startDate,
      endDate
    )
  );
  // Interval Run
  setInterval(() =>
    countdownRender(
      anchor,
      getCountdownInterval(
        startDate,
        endDate
      )
    ), 1000);
}

export { countdown };