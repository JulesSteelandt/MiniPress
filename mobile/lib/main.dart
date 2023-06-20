import 'package:flutter/material.dart';
import 'package:mobile/providers/articles_provider.dart';
import 'package:provider/provider.dart';

import 'minipress_home.dart';

void main() {
  runApp(
      ChangeNotifierProvider(
        create: (context) => ArticlesProvider(),
        child: const MiniPressApp()
      ),
  );
}