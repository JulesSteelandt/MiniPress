import 'package:flutter/material.dart';
import 'package:mobile/providers/articles_provider.dart';
import 'package:mobile/screens/article_preview.dart';
import 'package:provider/provider.dart';

class MiniPressApp extends StatefulWidget {
  const MiniPressApp({super.key});

  @override
  State<StatefulWidget> createState() => _MiniPressAppState();
}

class _MiniPressAppState extends State<MiniPressApp> {
  @override
  void initState() {
    super.initState();
    Provider.of<ArticlesProvider>(context, listen: false).fetchArticles();
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'MiniPress App',
      home: Scaffold(
          appBar: AppBar(
            backgroundColor: Colors.lightGreen,
            title: const Text('MiniPress App'),
          ),
          body: Consumer<ArticlesProvider>(
            builder: (context, provider, child) {
              if (provider.allArticles.isEmpty) {
                return Center(
                  child: Transform.scale(
                    scale: 4.0,
                    child: const CircularProgressIndicator(
                      backgroundColor: Colors.lightGreenAccent,
                      color: Colors.green,
                      strokeWidth: 4,
                    ),
                  ),
                );
              } else {
                return ListView.builder(
                    itemCount: provider.allArticles.length,
                    itemBuilder: (BuildContext context, int index) {
                      return ArticlePreview(
                          article: provider.allArticles[index]);
                    });
              }
            },
          )),
    );
  }
}
