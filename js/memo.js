/*global $, dotclear */
'use strict';

dotclear.ready(() => {
  $('#edit-entry').on('onetabload', () => {
    $('#memo').toggleWithDetails({
      user_pref: 'dcx_post_memo',
    });
  });
});
