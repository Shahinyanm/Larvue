/*
 * FontAwesome 5.1 ! (Currrently a pre-release!)
 * 
 * Using SVG Icons from FontAwesome.
 */

import { config, library, dom } from '@fortawesome/fontawesome-svg-core'

config.autoReplaceSvg = 'nest';

// Default usage icons
import {
    faSpinner,
    faSearch,
    faSignInAlt,
    faSignOutAlt,
    faEye,
    faEyeSlash,
    faAngleRight,
    faAngleLeft,
    faCalendar,
    faClock
} from '@fortawesome/free-solid-svg-icons';

library.add(
    faSpinner,
    faSearch,
    faSignInAlt,
    faSignOutAlt,
    faEye,
    faEyeSlash,
    faAngleRight,
    faAngleLeft,
    faCalendar,
    faClock
);

// Icons for main page
import {
    faUniversalAccess,
    faUserCircle,
    faCaretDown,
    faCaretUp

} from '@fortawesome/free-solid-svg-icons';

library.add(
    faUniversalAccess,
    faUserCircle,
    faCaretDown,
    faCaretUp
);

// Icons for Master / Detail management
// Kicks off the process of finding <i> tags and replacing with <svg>
dom.watch()