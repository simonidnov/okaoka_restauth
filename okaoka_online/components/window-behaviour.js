var gui = window.require('nw.gui');
var platform = require('./platform');
var settings = require('./settings');

module.exports = {
  /**
   * Update the behaviour of the given window object.
   */
  set: function(win) {
    // Show the window when the dock icon is pressed
    gui.App.removeAllListeners('reopen');
    gui.App.on('reopen', function() {
      win.show();
    });

    // Don't quit the app when the window is closed
    if (!platform.isLinux) {
      win.removeAllListeners('close');
      win.on('close', function(quit) {
        if (quit) {
          this.saveWindowState(win);
          win.close(true);
        } else {
          win.hide();
        }
      }.bind(this));
    }
  },

  /**
   * Change the new window policy to open links in the browser or another window.
   */
  setNewWinPolicy: function(win) {
    win.removeAllListeners('new-win-policy');
    win.on('new-win-policy', function(frame, url, policy) {
      if (settings.openLinksInBrowser) {
        gui.Shell.openExternal(url);
        policy.ignore();
      } else {
        policy.forceNewWindow();
      }
    });
  },

  /**
   * Listen for window state events.
   */
  bindWindowStateEvents: function(win) {
    win.removeAllListeners('maximize');
    win.on('maximize', function() {
      win.sizeMode = 'maximized';
    });

    win.removeAllListeners('unmaximize');
    win.on('unmaximize', function() {
      win.sizeMode = 'normal';
    });

    win.removeAllListeners('minimize');
    win.on('minimize', function() {
      win.sizeMode = 'minimized';
    });

    win.removeAllListeners('restore');
    win.on('restore', function() {
      win.sizeMode = 'normal';
    });
  },

  /**
   * Store the window state.
   */
  saveWindowState: function(win) {
    var state = {
      mode: win.sizeMode || 'normal'
    };

    if (state.mode == 'normal') {
      state.x = win.x;
      state.y = win.y;
      state.width = win.width;
      state.height = win.height;
    }

    settings.windowState = state;
  },

  /**
   * Restore the window size and position.
   */
  restoreWindowState: function(win) {
    var state = settings.windowState;

    if (state.mode == 'maximized') {
      win.maximize();
    } else {
      win.resizeTo(state.width, state.height);
      win.moveTo(state.x, state.y);
    }

    win.show();
  }
};
