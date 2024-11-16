/*global dotclear */
'use strict';

dotclear.ready(() => {
  const memo = document.getElementById('memo');
  if (memo)
    dotclear.toggleWithDetails(memo, {
      user_pref: 'dcx_post_memo',
    });
});
