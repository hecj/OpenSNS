--
-- 转存表中的数据 `ocenter_menu`
--

REPLACE INTO `ocenter_menu` (`id`, `title`, `pid`, `sort`, `url`, `hide`, `tip`, `group`, `is_dev`, `icon`) VALUES
(2, '用户', 0, 2, 'User/index', 0, '', '', 0, 'user'),
(2344, '角色', 0, 3, 'Role/index', 0, '', '', 0, 'group'),
(2345, '角色列表', 2344, 0, 'Role/index', 0, '', '角色管理', 0, ''),
(2346, '编辑角色', 2344, 0, 'Role/editRole', 1, '', '', 0, ''),
(2347, '启用、禁用、删除角色', 2344, 0, 'Role/setStatus', 1, '', '', 0, ''),
(2348, '角色排序', 2344, 0, 'Role/sort', 1, '', '', 0, ''),
(2349, '默认积分配置', 2345, 0, 'Role/configScore', 1, '', '', 0, ''),
(2350, '默认权限配置', 2345, 0, 'Role/configAuth', 1, '', '', 0, ''),
(2351, '默认头像配置', 2345, 0, 'Role/configAvatar', 1, '', '', 0, ''),
(2352, '默认头衔配置', 2345, 0, 'Role/configRank', 1, '', '', 0, ''),
(2353, '默认字段管理', 2345, 0, 'Role/configField', 1, '', '', 0, ''),
(2354, '角色分组', 2344, 0, 'Role/group', 0, '', '角色管理', 0, ''),
(2355, '编辑分组', 2354, 0, 'Role/editGroup', 1, '', '', 0, ''),
(2356, '删除分组', 2354, 0, 'Role/deleteGroup', 1, '', '', 0, ''),
(2357, '角色基本信息配置', 2344, 0, 'Role/config', 1, '', '角色管理', 0, ''),
(2358, '用户列表', 2344, 0, 'Role/userList', 0, '', '角色用户管理', 0, ''),
(2359, '设置用户状态', 2358, 0, 'Role/setUserStatus', 1, '', '', 0, ''),
(2360, '审核用户', 2358, 0, 'Role/setUserAudit', 1, '', '', 0, ''),
(2361, '迁移用户', 2358, 0, 'Role/changeRole', 1, '', '', 0, ''),
(2362, '上传默认头像', 2351, 0, 'Role/uploadPicture', 1, '', '', 0, '');